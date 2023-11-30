import React, { useEffect, useReducer, useState } from "react";
import { ChatContext, ChatReducer, InitialState } from "./ChatContext";
import useEcho from "../hook/useEcho";
import useCurrentUser from "../hook/useCurrentUser";

export default function ChatProvicer({ children }) {
    const [state, dispatch] = useReducer(ChatReducer, InitialState);
    const [tmp, setTmp] = useState();
    const contextValue = {
        state,
        dispatch,
    };
    useEffect(() => {
        const loadConversations = async () => {
            const req = await fetch(
                `${document.location.origin}/chat/conversations`
            );
            const conversations = await req.json();
            dispatch({
                type: "ADD_CONVERSATIONS",
                payload: conversations,
            });
            function handleWebSocket(e) {
                dispatch({
                    type: "ADD_MESSAGE",
                    senderId: e.message.senderId,
                    payload: e.message,
                });
                dispatch({
                    type: "INCREMENT_UNSEEN_COUNT",
                    senderId: e.message.senderId,
                });
            }
            const user = await useCurrentUser();
            useEcho(
                `ChatRoom.${user.id}`,
                "ChatMessagePublished",
                handleWebSocket
            );
        };
        loadConversations();
    }, [tmp]);
    return (
        <ChatContext.Provider value={contextValue}>
            {children}
        </ChatContext.Provider>
    );
}
