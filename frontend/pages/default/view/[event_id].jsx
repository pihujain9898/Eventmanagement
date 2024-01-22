import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useRouter } from 'next/router';
import Link from 'next/link';
import Navbar from '@/components/Default/Navbar';

export default function EventId() {
    const router = useRouter();
    const {view, event_id} = router.query;
    const [data, setData] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
        try {
          const response = await axios.get(`http://localhost/eventmanage/default/view/${event_id}`);
          setData(response.data);
        } catch (error) {
          console.error(error);
        }
      };
      if(event_id)
        fetchData();
    }, [event_id]);
    console.log(data);
  return (
    
    // <div className="">
    //     {data.event ? <h1>{data.event.name}</h1> : "No event found"}
    //     <br />
    //   {Array.isArray(data.tickets) && data.tickets.length > 0 ? (
    //     data.tickets.map((item) => 
    //     <Link key={item.id} href={`/default/ticket/${item.id}`}>
    //         <h1>{item.name}</h1>
    //     </Link>
    //     )
    //   ) : (
    //     <p>No tickets available</p>
    //   )}
    // </div>
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <Navbar />
    {
      data.event ? 
      <div className="flex flex-col sm:flex-row mt-20">
        <div className="w-2/5">
          <img src={data.event.image ? "http://localhost/eventmanage/uploads/"+data.event.image: ""} alt="Cover Image" className="w-full h-auto" />
        </div>
        <div className="flex flex-col justify-center sm:ml-4 w-3/5">
          <h1 className="text-4xl font-bold mb-2">{data.event.name}</h1>
          <p className="text-gray-400 mb-2">{data.event.start_time.split("T")[0].split("-").reverse().join("-")} | {data.event.start_time.split("T")[1].split(":").slice(0, 2).join(":")}</p>
          <p className="text-lg mb-4">{data.event.introduction}</p>
          <p className="text-lg mb-4">{data.event.information}</p>
          <p className="text-lg mb-4">{data.event.notices}</p>
          <p className="text-lg mb-4">{data.event.policies}</p>
          <div className="flex space-x-4">
          <Link href={`/default/tickets/${data.event.id}`}>
            <button className="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">
              Book Now
            </button>
          </Link>
            {/* <button className="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
              Button 2
            </button> */}
          </div>
        </div>
      </div>
  : ""
}
</div>
  )
}
