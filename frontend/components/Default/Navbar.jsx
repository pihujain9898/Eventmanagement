import React from 'react';
import Link from 'next/link';
import { useRouter } from 'next/router';
import { useSelector, useDispatch } from 'react-redux';
import { setUser } from '@/store/actions/setUserAction';

export default function () {
  const router = useRouter();
  const dispatch = useDispatch();
  const user = useSelector((state) => state.user);
  // if (user) {
  //   router.push('/');
  // }
  const handleLogout = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch('http://localhost/eventmanage/logout', { credentials: 'include' });
      const { message } = await response.json();
      console.log(response);
      if(message){
        dispatch(setUser(null));
        router.push({ pathname: '/', query: { message: message, message_type:'success' } });
        localStorage.removeItem('jwtToken');
      }
    } catch (error) {
      router.push({ pathname: '/', query: { message: error, message_type:'failed' } });
    }
  };

  return (
    <nav className="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <Link className="text-white font-bold text-xl" href="/">
                Your Logo
              </Link>
            </div>
          </div>
          <div className="hidden md:block">
            <div className="ml-10 flex items-baseline space-x-4">
              <Link className="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium" href="/about">
                About
              </Link>
              <Link className="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium" href="/contact">
                Contact
              </Link>
              {user ? 
                  <a className="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium" onClick={handleLogout} href="">Logout</a>
               : 
                  <>
                  <Link className="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium" href="/signup">Signup</Link>
                  <Link className="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium" href="/login">Login</Link>
                  </>
              }
            </div>
          </div>
        </div>
      </div>
    </nav>
  );
};
