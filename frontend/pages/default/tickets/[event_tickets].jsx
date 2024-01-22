import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useRouter } from 'next/router';
import Link from 'next/link';
import Navbar from '@/components/Default/Navbar';

export default function EventTickets() {
  const router = useRouter();
  const { view, event_tickets } = router.query;
  const [data, setData] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(`http://localhost/eventmanage/default/tickets/${event_tickets}`);
        setData(response.data);
        // console.log(response);
      } catch (error) {
        console.error(error);
      }
    };
    if (event_tickets)
      fetchData();
  }, [event_tickets]);
  
  // console.log(data[0] ? data[0] : '');

  const getSelectOptions = (n) => {
    const options = [];
    for (let i = 0; i <= n; i++) {
      options.push(
        <option key={i} value={i}>
          {i}
        </option>
      );
    }
    return options;
  };

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <Navbar />
      <div className="flex mt-10 gap-20">
        <div className="w-2/6 bg-white shadow-lg p-8">
          <h3 className='text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight mb-3'>Event Information</h3>
          <h6 className='text-base text-slate-800'>{data[0] ? data[0]['event_association']['start_time'].split("T")[1].split(":").slice(0, 2).join(":")+" | "+data[0]['event_association']['start_time'].split("T")[0].split("-").reverse().join("-") : ""}</h6>
          <img
            src={data[0] ? "http://localhost/eventmanage/uploads/"+data[0].event_association.image: ""}
            alt="Cover Image"
            className="w-full h-auto my-6"
          />
          <h5 className='text-base'>{data[0] ? data[0]['event_association']['introduction'] : ""}</h5>
        </div>
        <div className="w-4/6 bg-white shadow-lg p-8">
          <h2 className='text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight mb-3 mx-6'>{data[0] ? data[0].event_association.name + " tickets" : ''}</h2>
          {Array.isArray(data) && data.length > 0 ? (
            data.map((item) => (
              <div key={item.id} className="bg-white rounded-lg shadow-sm p-6  mb-4">
                <div className="flex justify-between">
                  <h2 className="text-2xl font-bold text-purple-500">{item.name}</h2>
                  <div className="relative">                  
                    <select className="block appearance-none w-full bg-purple-100 border border-purple-200 text-purple-500 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                      {getSelectOptions(item.avilable_quantity < item.max_purchase_value ? item.avilable_quantity : item.max_purchase_value)}
                    </select>
                    <div className="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                      <svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                          fillRule="evenodd"
                          d="M7.293 6.707a1 1 0 0 0 0 1.414L10 11.414l2.707-2.707a1 1 0 1 0-1.414-1.414L10 8.586l-2.293-2.293a1 1 0 0 0-1.414 0z"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
                <hr className="my-4" />
                <p className="text-lg text-gray-800">{item.description}</p>
                <p className="text-base text-gray-600">
                  Last Date to Book: {new Date(item.expiry).toLocaleString('en-US', {
                      day: '2-digit',
                      month: 'short',
                      year: 'numeric',
                      hour: 'numeric',
                      minute: 'numeric',
                      hour12: true,
                  })}
                  <br />
                  Price: <span className="font-bold text-purple-500">₹{item.price}</span> <span className="text-gray-400 line-through">₹{item.price+item.price*0.1}</span>
                  <br />
                  <span className='text-pink-600'>You will save 10% on this booking.</span>
                </p>
              </div>
            )
            )
          ) : (
            <p>No tickets available</p>
          )}

        </div>
      </div>
    </div>
  )
}
