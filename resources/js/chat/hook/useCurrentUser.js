 const user = async ()=>{
    const req = await fetch(`${document.location.origin}/api/user`);
    const user = await req.json();
    return user;
}

export default user;
