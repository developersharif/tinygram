import { MessageList } from '@chatscope/chat-ui-kit-react';
import Layout from './Layout'

export default function Home() {
  return (
    <Layout>
        <MessageList>
          <MessageList.Content style={{
        display: "flex",
        "flexDirection": "column",
        "justifyContent": "center",
        height: "100%",
        textAlign: "center",
        fontSize: "1.2em"
      }}>
           No Chats Selected
          </MessageList.Content>
        </MessageList>
    </Layout>
  )
}
