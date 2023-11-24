import { createHashRouter } from "react-router-dom";
import Chat from "./Chat";
import ChatBody from "./ChatBody";

const Web = createHashRouter([
    {
        path:"/",
        element:<Chat/>
    },
    {
        path:"/:chatId",
        element:<ChatBody/>,
        loader:async ({params})=>{
            const chatId = params.chatId;
            const req = await fetch(`${window.location.origin}/chat/conversations/${chatId}`);
            const reply = await req.json();
            return {messages: reply}
        }
    }
])

export default Web;
