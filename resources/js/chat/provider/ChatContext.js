import { createContext } from "react";

const ChatContext = createContext();

//initial state array of conversations
const InitialState = {
    //   conversations: [
    //     {
    //       id: 1,
    //       name: "sharif",
    //       userName: "sharif",
    //       avatar: "https://source.unsplash.com/user/c_v_r",
    //       status: "available",
    //       lastMessage: "Hey",
    //       timeStamp: "2023-11-25 09:12:0",
    //       messages: [
    //         {
    //           id: 1,
    //           text: "hey",
    //           senderId: 1,
    //           timeStamp: "2023-11-25 09:12:03",
    //         },
    //       ],
    //     },
    //     {
    //       id: 2,
    //       name: "Demo",
    //       userName: "demo",
    //       avatar: "https://source.unsplash.com/user/c_v_r",
    //       status: "available",
    //       lastMessage: "Hello",
    //       timeStamp: "2023-11-25 09:12:0",
    //       messages: [
    //         {
    //           id: 2,
    //           text: "hello",
    //           senderId: 2,
    //           timeStamp: "2023-11-25 09:12:03",
    //         },
    //       ],
    //     },
    //   ],
};

const ChatReducer = (state, action) => {
    switch (action.type) {
        case "ADD_MESSAGE":
            return {
                ...state,
                conversations: state.conversations.map((conversation) =>
                    conversation.id === action.senderId
                        ? {
                              ...conversation,
                              messages: [
                                  ...conversation.messages,
                                  action.payload,
                              ],
                          }
                        : conversation
                ),
            };
        case "INCREMENT_UNSEEN_COUNT":
            return {
                ...state,
                conversations: state.conversations.map((conversation) =>
                    conversation.id === action.senderId
                        ? {
                              ...conversation,
                              unseenCount: (
                                  parseInt(conversation.unseenCount) + 1
                              ).toString(),
                          }
                        : conversation
                ),
            };

        case "MARK_AS_READ":
            return {
                ...state,
                conversations: state.conversations.map((conversation) =>
                    conversation.id === action.senderId
                        ? {
                              ...conversation,
                              unseenCount: "0",
                          }
                        : conversation
                ),
            };

        case "ADD_MESSAGES":
            return {
                ...state,
                conversations: state.conversations.map((conversation) =>
                    conversation.id === action.userId
                        ? {
                              ...conversation,
                              messages: [
                                  // ...conversation.messages,
                                  ...action.payload.map((message) => ({
                                      id: message.id,
                                      text: message.text,
                                      senderId: message.senderId,
                                      timeStamp: message.timestamp,
                                  })),
                              ],
                          }
                        : conversation
                ),
            };

        case "ADD_CONVERSATION":
            const existingConversation = state.conversations.find(
                (conversation) => conversation.id === action.payload.id
            );

            if (existingConversation) {
                return state;
            }
            return {
                ...state,
                conversations: [
                    {
                        id: action.payload.id,
                        name: action.payload.name,
                        userName: action.payload.userName,
                        avatar: action.payload.avatar,
                        status: action.payload.status,
                        lastMessage: action.payload.lastMessage,
                        timeStamp: action.payload.timeStamp,
                        messages: [],
                    },
                    ...state.conversations,
                ],
            };

        case "ADD_CONVERSATIONS":
            if (Array.isArray(action.payload)) {
                return {
                    ...state,
                    conversations: [
                        // ...state.conversations,
                        ...action.payload.map((newConversation) => ({
                            ...newConversation,
                            messages: [],
                        })),
                    ],
                };
            }
            return state;
        default:
            return state;
    }
};
export { ChatContext, InitialState, ChatReducer };
