import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useDispatch, useSelector  } from 'react-redux';
import { setUser } from '../store/actions/setUserAction';
import { useRouter } from 'next/router';
import Link from 'next/link';
import Navbar from '@/components/Default/Navbar';
import Notification  from '@/components/Default/Notification';

const SignupPage = () => {
  const router = useRouter();
  const user = useSelector((state) => state.user);
  if (user) {
    router.push('/');
  }
  const dispatch = useDispatch();
  const { message, message_type } = router.query;
  const [fname, setFname] = useState('');
  const [lname, setLname] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  
  const handleSubmit = async (e) => {
    e.preventDefault();
    let userData = {
      fname,
      lname,
      email,
      password,
    };
    try {
      const response = await axios.post('http://localhost/eventmanage/signup', userData, {
          withCredentials: true,
      });
      if(response.data.userEnt){
        dispatch(setUser(response.data));
        setFname('');
        setLname('');
        setEmail('');
        setPassword('');
        router.push({ pathname: '/', query: { message: response.data.message, message_type:'success' } });
      } else{
        router.push({ pathname: '/signup', query: { message: response.data.message, message_type:'failed' } });
      }
    } catch (error) {
      router.push({ pathname: '/signup', query: { message: error, message_type:'failed' } });
      // console.error(error); // Handle any errors
    }
  };

  return (
    <>
      <Navbar />
      <div>
        {message ? <Notification message={message} message_type={message_type}  /> : ""}
      </div>
      <div className="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div className="sm:mx-auto sm:w-full sm:max-w-md">
          <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Sign up for an account
          </h2>
        </div>
        <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
          <div className="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form id='signup-form' onSubmit={handleSubmit}>
              <div>
                <label htmlFor="fname" className="block text-sm font-medium text-gray-700">
                  First Name
                </label>
                <div className="mt-1">
                  <input
                    type="text"
                    name="fname"
                    id="fname"
                    value={fname}
                    onChange={(e) => setFname(e.target.value)}
                    autoComplete="given-name"
                    className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>
              <div className="mt-6">
                <label htmlFor="lname" className="block text-sm font-medium text-gray-700">
                  Last Name
                </label>
                <div className="mt-1">
                  <input
                    type="text"
                    name="lname"
                    id="lname"
                    value={lname}
                    onChange={(e) => setLname(e.target.value)}
                    autoComplete="family-name"
                    className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>
              <div className="mt-6">
                <label htmlFor="email" className="block text-sm font-medium text-gray-700">
                  Email
                </label>
                <div className="mt-1">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    autoComplete="email"
                    className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>
              <div className="mt-6">
                <label htmlFor="password" className="block text-sm font-medium text-gray-700">
                  Password
                </label>
                <div className="mt-1">
                  <input
                    type="password"
                    name="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    autoComplete="new-password"
                    className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>
              <div className="mt-6">
                <button
                  type="submit"
                  className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  Sign up
                </button>
              </div>
              <div className="mt-4 text-center">
            Already have an account?{' '}
            <Link href="/login" className="text-blue-500">
              Login
            </Link>
          </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
}

export default SignupPage;