import React, { useContext, useEffect, useState } from "react";
import {
    Message,
    InfoButton,
    TypingIndicator,
    ConversationHeader,
    Avatar,
    MessageList,
    MessageInput,
} from "@chatscope/chat-ui-kit-react";
import { useParams } from "react-router-dom";
import Layout from "./Layout";
import { ChatContext } from "../../provider/ChatContext";
export default function ChatMessage() {
    const { chatId } = useParams();
    const chatIdInt = parseInt(chatId);
    const { state, dispatch } = useContext(ChatContext);
    const [messageInputValue, setMessageInputValue] = useState();
    const chatUser = state?.conversations?.filter(
        (conversation) => conversation.id === chatIdInt
    )[0];
    const conversationsLoaded = state?.conversations;
    useEffect(() => {
        const loadChatHistory = async () => {
            const req = await fetch(`${document.location.origin}/chat/conversations/${chatId}`);
            const reply = await req.json();
            dispatch({
                type: "ADD_MESSAGES",
                userId: chatIdInt,
                payload: reply.messagesList,
            });
        };
        setTimeout(()=>loadChatHistory(),10);
        // Load chat history when the component mounts
    }, [chatIdInt]);
    async function handleSubmit() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let req =  await fetch(`${document.location.origin}/chat/conversations/${chatId}`, {
            method: "POST",
            body: JSON.stringify({text:messageInputValue}),
            headers:{
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            }
          })
          let res = await req.json();
        dispatch({
            type:'ADD_MESSAGE',
            senderId:chatIdInt,
            payload:res.message
        });
        setMessageInputValue("");
    }
    if (conversationsLoaded) {
        if(chatUser === undefined) {
            const loadNewConversation = async ()=>{
                const req = await fetch(`${document.location.origin}/api/user/${chatId}`);
                const res = await req.json();
                dispatch({
                    type:'ADD_CONVERSATION',
                    payload:{
                        id:res.id,
                        name:res.name,
                        userName:res.username,
                        avatar:res.avatar,
                        status:'available',
                        lastMessage:'',
                        timeStamp:'',
                    }
                })
            }
            loadNewConversation()
        }

        if(parseInt(chatUser?.unseenCount)>0){
            const markAsRead = async ()=>{
                const req = await fetch(`${document.location.origin}/chat/conversations/${chatId}/mark_as_Read`);
                const res = req.status;
                if(res === 200) {
                    dispatch({
                        type:"MARK_AS_READ",
                        senderId:chatIdInt
                    });
                }

            }
            markAsRead();

        }

    }
    return (
        <>
            <Layout>
                <ConversationHeader>
                    <ConversationHeader.Back />
                    <Avatar src={chatUser?.avatar && `${document.location.origin}/storage/profile/${chatUser.avatar}`} name={chatUser && chatUser?.name} />
                    <ConversationHeader.Content
                        userName={chatUser?.name && chatUser.name}

                    />
                    <ConversationHeader.Actions>
                        {/*<VoiceCallButton />
                      <VideoCallButton />*/}
                        <InfoButton />
                    </ConversationHeader.Actions>
                </ConversationHeader>
                <MessageList typingIndicator={'Typing'}>
                    {chatUser && chatUser?.messages?.map((message, index) => (
                        <Message
                            model={{
                                message: message.text,
                                sentTime: "15 mins ago",
                                sender: "Zoe",
                                direction:
                                message.senderId === chatUser.id
                                        ? "incoming"
                                        : "outgoing",
                                position: "single",
                            }}
                            key={index}
                        >
                            <Message.Header sentTime={`${timeAgo(message.timeStamp)}`} />
                            {message.senderId === chatUser.id && (
                                <Avatar src={`${document.location.origin}/storage/profile/${chatUser.avatar}`} />
                            )}
                        </Message>
                    ))}
                </MessageList>
                <MessageInput
                    placeholder="Type message here"
                    value={messageInputValue}
                    onChange={(val) => setMessageInputValue(val)}
                    onSend={handleSubmit}
                    attachButton={false}
                    autoFocus={true}
                />
            </Layout>
        </>
    );
}
