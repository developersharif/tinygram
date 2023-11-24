/* eslint-disable react/prop-types */

import { memo } from "react";
import { Link } from "react-router-dom";

function User({users}) {
    console.log("User Rendered");
    return (<>
    <div className="content-chat-user">
        <div className="head-search-chat">
            <Link to="/"><h4 className="text-center">Chats</h4></Link>
        </div>

        <div className="list-search-user-chat mt-2">
            {users && users.map((user,index)=>(
                <Link to={`/${user.id}`} key={index}>
                <div className="user-chat" >
                <div className="user-chat-img">
                    <img src={`${window.location.origin}/storage/profile/${user.avatar}`}
                        alt=""/>
                    <div className={user.status}></div>
                </div>

                <div className="user-chat-text">
                    <p className="mt-0 mb-0"><strong>{user.name}</strong></p>
                    <small>{user.last_message}</small>
                </div>
            </div>
            </Link>
            ))}

        </div>
    </div>
    </>);
}

export default memo(User);
