import React, { useEffect, useState } from 'react';


const Notification = ({ message, message_type }) => {
  const [showNotification, setShowNotification] = useState(true);
  const [messageColor, setMessageColor] = useState('');

  useEffect(() => {
    const timeout = setTimeout(() => {
      setShowNotification(false);
    }, 5000);
    return () => clearTimeout(timeout);
  }, []);

  const handleDismiss = () => {
    setShowNotification(false);
  };

  useEffect(() => {
    if (message_type === 'success') {
      setMessageColor('green');
    } else if (message_type === 'failed') {
      setMessageColor('red');
    }
  }, [message_type]);

  return (
    <>
      {showNotification && (
        <div style={{backgroundColor: messageColor || ''}} className={`text-white py-4 px-6 rounded-md flex items-center justify-between`}>
          <p>{message}</p>
          <button onClick={handleDismiss} className="text-white">
            X
          </button>
        </div>
      )}
    </>
  );
};

export default Notification;