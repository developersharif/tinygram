import Home from "./components/chat/Home"
import { RouterProvider } from "react-router-dom"
import Web from "./components/Web"
import ChatProvicer from "./provider/ChatProvicer"
function App() {
  return (
    <ChatProvicer>
      <RouterProvider router={Web}>
        <Home />
      </RouterProvider>
      </ChatProvicer>
  );
}
export default App
