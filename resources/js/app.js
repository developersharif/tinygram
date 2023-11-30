import './bootstrap';

import Alpine from 'alpinejs';
import useEcho from './chat/hook/useEcho';

window.Alpine = Alpine;

Alpine.start();

function timeAgo(timestamp) {
    const currentDate = new Date();
    const date = new Date(timestamp);
    const seconds = Math.floor((currentDate - date) / 1000);

    const intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60,
        second: 1,
    };

    for (const [interval, secondsInInterval] of Object.entries(intervals)) {
        const count = Math.floor(seconds / secondsInInterval);

        if (count > 0) {
            return count === 1
                ? `${count} ${interval} ago`
                : `${count} ${interval}s ago`;
        }
    }

    return 'Just now';
}
function isLiked(likes, myId) {
    // Iterate through the likes array
    for (var i = 0; i < likes.length; i++) {
      var like = likes[i];
      if (like.pivot.user_id === myId) {
        return true; // Found a match, return true
      }
    }

    return false; // No match found, return false
  }
window.isLiked = isLiked;
window.timeAgo = timeAgo;
async function hanldeWebSocket(){
    const req = await fetch(`${document.location.origin}/api/user`);
    const user = await req.json();
    useEcho(`ChatRoom.${user.id}`,'ChatMessagePublished',function(e){
        const previousMessage = document.getElementById("message-indicator");
        const previousMessageMobile = document.getElementById("message-indicator-mobile");
        if(previousMessage === null){
            let messageHref = document.getElementById("message-href");
            let messageHrefMobile = document.getElementById("message-href-mobile");
            messageHref.insertAdjacentHTML('afterbegin',`<sup class="badge bg-red-600  text-white scale-75 absolute top-1 left-4"
            id="message-indicator">
    1
        </sup>`)
        messageHrefMobile.insertAdjacentHTML('afterbegin',`<sup class="badge bg-red-600  text-white scale-75 absolute top-1 left-4"
            id="message-indicator">
    1
        </sup>`)
        }else{
            previousMessage.innerText = parseInt(previousMessage.innerText) + 1;
            previousMessageMobile.innerText = parseInt(previousMessage.innerText) + 1;
        }
    });
}
hanldeWebSocket();
