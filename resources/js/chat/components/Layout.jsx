import { useContext } from "react";
import User from "./User";
import { GlobalData } from "../provider/GlobalData";

/* eslint-disable react/prop-types */
function Layout({children}) {
    const GlobalContext = useContext(GlobalData)
    let users = GlobalContext.data?.conversations
    users?.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));
    return (<>
    <div className="container">
<div className="content-chat">
<User users={GlobalContext?.data?.conversations}/>
{children}
    </div>
</div>
    </>);
}

export default Layout;