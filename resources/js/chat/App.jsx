import Chat from "./components/Chat"
import "./assets/style.css"
import { RouterProvider } from "react-router-dom"
import Web from "./components/Web"
import { GlobalData } from "./provider/GlobalData"
import { useEffect, useState } from "react"
function App() {
  const [data, setData] = useState();
  useEffect(() => {
    const loadConversations = async () => {
      const req = await fetch(`http://127.0.0.1:8000/chat/conversations`);
      const conversations = await req.json();
      setData((prevData) => ({ ...prevData, conversations: conversations }));
    };

    const loadUser = async () => {
      let response = await fetch(`http://127.0.0.1:8000/api/user`);
      let user = await response.json();
      setData((prevData) => ({ ...prevData, user: user }));
    };

    loadConversations();
    loadUser();
  }, []);

  return (
    <GlobalData.Provider value={{ data, setData }}>
      <RouterProvider router={Web}>
        <Chat />
      </RouterProvider>
    </GlobalData.Provider>
  );
}


export default App
