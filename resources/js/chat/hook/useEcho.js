import axios from 'axios';
import {useEffect} from "react";
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */



const useEcho = (channel, event, callback) => {
let listenerInstance; // Variable to track the listener instance
  useEffect(() => {
    console.log("Setting up Laravel Echo...");

    const echo = new Echo({
      broadcaster: 'pusher',
      key: import.meta.env.VITE_PUSHER_APP_KEY,
      cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
      wsHost: import.meta.env.VITE_PUSHER_HOST
        ? import.meta.env.VITE_PUSHER_HOST
        : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
      wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
      wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
      forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
      enabledTransports: ['ws', 'wss'],
      authEndpoint: 'http://127.0.0.1:8000/broadcasting/auth',
      auth: {
        headers: {
          // Development Mode
          Authorization: 'Bearer ' + '1|hd3ZbRx9OdNDP4eK37Hn1d0howyPKuceHALqE67Z4d6f9ac1',
        },
      },
    });
    if (!listenerInstance) {
      // If not, create a new listener
      listenerInstance = echo.private(channel).listen(event, callback);
      console.log("Listener created:", listenerInstance);
    } else {
      // If a listener already exists, log a message
      console.log("Listener already exists. Skipping creation.");
    }    
    return () => {
      if (listenerInstance) {
        console.log("Cleaning up listener...");
        echo.leave(channel)
        listenerInstance = null; // Reset the listener instance
      }
    };
  }, [channel, event, callback]);
};

export default useEcho;
