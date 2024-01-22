import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import { useRouter } from 'next/router';
import axios from 'axios';
import { useDispatch, useSelector  } from 'react-redux';
import { setUser } from '../store/actions/setUserAction';
import Navbar from '@/components/Default/Navbar';
import Notification  from '@/components/Default/Notification';

export default function Login() {
  
  const router = useRouter();
  const user = useSelector((state) => state.user);
  if (user) {
    router.push('/');
  }
  const dispatch = useDispatch();
  // dispatch(setUser(null));
  const { message, message_type } = router.query;
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  useEffect(() => {}, []);
  const handleSubmit = async (e) => {
    e.preventDefault();
    let userData = {
      email,
      password,
    };
    try {
      const response = await axios.post('http://localhost/eventmanage/login', userData, {
        withCredentials: true,
      });
      const data = response.data;
      if (data.userEnt) {
        let token = data.userEnt.token;
        dispatch(setUser(data));
        setEmail('');
        setPassword('');        
        router.push({ pathname: '/', query: { message: data.message, message_type: 'success' } });
      } else {
        router.push({ pathname: '/login', query: { message: data.message, message_type: 'failed' } });
      }
    } catch (error) {
      console.error(error);
      router.push({ pathname: '/login', query: { message: error, message_type: 'failed' } });
    }
  };

  return (
    <>
      <Navbar />
      <div>
        {message ? <Notification message={message} message_type={message_type}  /> : ""}
      </div>
      <div className="flex justify-center items-center h-screen">
        <form className="bg-white p-8 rounded shadow" onSubmit={handleSubmit}>
          <h1 className="text-3xl font-bold text-center mb-8">Login</h1>
          <div className="mb-4">
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Email"
              className="w-full p-2 border border-gray-300 rounded"
            />
          </div>
          <div className="mb-4">
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="Password"
              className="w-full p-2 border border-gray-300 rounded"
            />
          </div>
          <button type="submit" className="w-full bg-blue-500 text-white py-2 rounded">
            Login
          </button>
          <div className="mt-4 text-center">
            Don't have an account?{' '}
            <Link href="/signup" className="text-blue-500">
              Sign up
            </Link>
          </div>
        </form>
      </div>
    </>
  );
}