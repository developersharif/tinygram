import React, { useEffect, useReducer, useState } from "react";
import { ChatContext, ChatReducer, InitialState } from "./ChatContext";

export default function ChatProvicer({ children }) {
    const [state, dispatch] = useReducer(ChatReducer, InitialState);
    const [tmp, setTmp] = useState();
    const contextValue = {
        state,
        dispatch,
    };
    useEffect(() => {
        const loadConversations = async () => {
                const req = await fetch(`${document.location.origin}/chat/conversations`);
                const conversations = await req.json();
                dispatch({
                    type: "ADD_CONVERSATIONS",
                    payload: conversations
                });
        };
        loadConversations();
    }, [tmp]);
    return (
        <ChatContext.Provider value={contextValue}>
            {children}
        </ChatContext.Provider>
    );
}
