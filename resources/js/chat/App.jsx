import Home from "./components/chat/Home"
// import "./assets/style.css"
import { RouterProvider } from "react-router-dom"
import Web from "./components/Web"
// import { GlobalData } from "./provider/GlobalData"
// import { useEffect, useState } from "react"
import ChatProvicer from "./provider/ChatProvicer"
function App() {
  // const [data, setData] = useState();
  // useEffect(() => {
  //   const loadConversations = async () => {
  //     const req = await fetch(`http://127.0.0.1:8000/api/chat/conversations`);
  //     const conversations = await req.json();
  //     setData((prevData) => ({ ...prevData, conversations: conversations }));
  //   };

  //   const loadUser = async () => {
  //     let response = await fetch(`http://127.0.0.1:8000/api/user`);
  //     let user = await response.json();
  //     setData((prevData) => ({ ...prevData, user: user }));
  //   };

  //   loadConversations();
  //   loadUser();
  // }, []); 

  return (
    <ChatProvicer>
      <RouterProvider router={Web}>
        <Home />
      </RouterProvider>
      </ChatProvicer>
  );
}


export default App
