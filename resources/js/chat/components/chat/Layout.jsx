import "@chatscope/chat-ui-kit-styles/dist/default/styles.min.css";
import "../../assets/style.css"
import {
  MainContainer,
  ChatContainer,
  Sidebar,
  ConversationList,
} from "@chatscope/chat-ui-kit-react";
import Users from "./Users";
function Layout({ children }) {
  return (
    <div
      style={{
        height: "95vh",
        position: "relative",
        width: "62vw",
      }}
    >
      <MainContainer responsive>
        <Sidebar position="left" scrollable={false}>
          {/* <Search placeholder="Search..." /> */}
          <ConversationList>
            <Users />
          </ConversationList>
        </Sidebar>
        <ChatContainer>{children}</ChatContainer>
      </MainContainer>
    </div>
  );
}

export default Layout;
