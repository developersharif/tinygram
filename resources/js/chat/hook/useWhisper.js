import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
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
  });
const useWhisper = (channel, event, callback) => {
let listenerInstance;

    if (!listenerInstance) {
      // If not, create a new listener
      listenerInstance = echo.private(channel).listenForWhisper(event, callback);

    }
    return () => {
      if (listenerInstance) {
        echo.leave(channel)
        listenerInstance = null; // Reset the listener instance
      }
    };
};

export const setWhisper = (channel, event, data) => {
    let listenerInstance;

        if (!listenerInstance) {
          // If not, create a new listener
          listenerInstance = echo.private(channel).whisper(event, data);

        }
        return () => {
          if (listenerInstance) {
            echo.leave(channel)
            listenerInstance = null; // Reset the listener instance
          }
        };
    };

export default useWhisper;
