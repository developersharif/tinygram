import { createHashRouter } from "react-router-dom";
// import Layout from "./chat/Layout";
import ChatMessage from "./chat/ChatMessage";
import Home from "./chat/Home";
const Web = createHashRouter([
    {
        path:"/",
        element:<Home/>
    },
    {
        path:"/:chatId",
        element:<ChatMessage/>
    },
    // {
    //     path:"/conversations/:chatId?",
    //     element:<ChatMessage/>
    // },
    // {
    //     path:"/:chatId",
    //     element:<ChatBody/>,
    //     loader:async ({params})=>{
    //         const chatId = params.chatId;
    //         const req = await fetch(`http://127.0.0.1:8000/api/chat/conversations/${chatId}`);
    //         const reply = await req.json();
    //         return {messages: reply}
    //     }
    // }
])

export default Web;
