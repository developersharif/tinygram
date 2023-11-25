import { useLoaderData, useParams } from "react-router-dom";
import Layout from "./Layout";
import { useContext, useEffect, useRef, useState } from "react";
import { GlobalData } from "../provider/GlobalData";
import useEcho from "../hook/useEcho"
function ChatBody() {
    const GlobalContext = useContext(GlobalData)
    const {chatId} = useParams()
    const [textInput,setTextInput] = useState();
    const [chatMessages,setChatMessages] = useState();
    const chatContainerRef = useRef();
    const loaderData = useLoaderData();
    const messages = loaderData.messages
    const user = GlobalContext.data?.user
    useEffect(() => {
        scrollToBottom();
      }, [chatMessages]);
      useEffect(()=>{
        function handleMessage(e){
            setChatMessages((prevData) => ({
                ...prevData,
                messagesList: [...prevData.messagesList, e.message],
              }));
        }
        setChatMessages(messages); //initialize the messages
        chatMessages?.messagesList?.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));
    useEcho(`ChatRoom.${chatId}`, 'ChatMessagePublished', handleMessage);

      },[messages]);
      const scrollToBottom = () => {
        chatContainerRef.current.scrollTop = chatContainerRef.current.scrollHeight;
      };
      async function handleSendMessage(e){
        e.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let req =  await fetch(`${window.location.origin}/chat/conversations/${chatId}`, {
            method: "POST",
            body: JSON.stringify({content:textInput}),
            headers:{
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': csrfToken,
            }
          })
          let res = await req.json();
          setChatMessages((prevData) => ({
            ...prevData,
            messagesList: [...prevData.messagesList, res.message],
          }));
          setTextInput('')
      }


    return (<>
    <Layout>
        <div className="content-chat-message-user active">
        <div className="head-chat-message-user">
            <a href={`/@${messages?.senderUsername}`}><img src={`${window.location.origin}/storage/profile/${messages?.senderAvatar}`}
                alt=""/></a>
            <div className="message-user-profile">
            <a href={`/@${messages?.senderUsername}`}> <p className="mt-0 mb-0 text-white"><strong>{messages?.senderName}</strong></p>
                <small className="text-white">
                    <p className={`${messages?.senderstatus}  mt-0 mb-0`}></p>{messages?.senderstatus}
                </small> </a>
            </div>
        </div>
        <div className="body-chat-message-user" ref={chatContainerRef}>
            {chatMessages?.messagesList && chatMessages?.messagesList?.map((message,index)=>(
                <div key={index}>
                    {(message.senderId !== user?.id) ? ( <div className="message-user-left">
                <div className="message-user-left-img">
                    <img src={`${window.location.origin}/storage/profile/${messages?.senderAvatar}`}
                        alt=""/>
                    <p className="mt-0 mb-0"></p>
                    <small>{timeAgo(message.timestamp)}</small>
                </div>
                <div className="message-user-left-text">
                    <strong>{message.content}</strong>
                </div>
            </div>) : (            <div className="message-user-right">
                <div className="message-user-right-img">
                    <p className="mt-0 mb-0"></p>
                    <small>{timeAgo(message.timestamp)}</small>
                    <img src={`${window.location.origin}/storage/profile/${user?.avatar}`}
                        alt=""/>
                </div>
                <div className="message-user-right-text">
                    <strong>{message.content}</strong>
                </div>
            </div>) }

                </div>
            ))}
        </div>
        <div className="footer-chat-message-user">
            <form onSubmit={handleSendMessage} className="message-user-send">
            <div className="message-user-send">
                <input type="text" placeholder="Text" value={textInput && textInput} onChange={(e)=>setTextInput(e.target.value)}/>
            </div>
            </form>
        </div>
    </div>
    </Layout>
    </>);
}

export default ChatBody;
