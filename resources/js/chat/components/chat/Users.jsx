import "@chatscope/chat-ui-kit-styles/dist/default/styles.min.css";
import {
  Avatar,
  Conversation,
} from "@chatscope/chat-ui-kit-react";
import { useContext, useEffect, useRef, useState } from "react";
import { ChatContext } from "../../provider/ChatContext";
import { Link,useLocation } from "react-router-dom";
function Users() {
  const { state, dispatch } = useContext(ChatContext);
  const location = useLocation();
  const { pathname } = location;
  const isActive = (id)=> (pathname.split('/').length > 1 && pathname.split("/")[1]==id)
  return (
    <>
      {state.conversations &&
        state?.conversations?.map((conversation, index) => (
          <Link to={`/${conversation.id}`} key={index}>
            <Conversation
              name={conversation.name}
              info={conversation.lastMessage}
              active={isActive(conversation.id)}
            >
              <Avatar
                src={`${document.location.origin}/storage/profile/${conversation.avatar}`}
                status={conversation.status}
              />
            </Conversation>
          </Link>
        ))}
    </>
  );
}

export default Users;
