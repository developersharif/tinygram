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
    const containerStyle = {
        height: "90vh",
        position: "relative",
      };
    return (
      <div style={{ ...containerStyle}}>
        {children ? (
          <MainContainer responsive>
            <Sidebar position="left" scrollable={false}>
              {/* <Search placeholder="Search..." /> */}
              <ConversationList>
                <Users />
              </ConversationList>
            </Sidebar>
            <ChatContainer>{children}</ChatContainer>
          </MainContainer>
        ) : (
          <ConversationList>
            <Users />
          </ConversationList>
        )}
      </div>
    );
  }

export default Layout;
