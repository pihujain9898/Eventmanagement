import React, { useEffect, useState, useRef } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Scrollbar } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/scrollbar';
import axios from 'axios';
import Navbar from '@/components/Default/Navbar';
import Notification from '@/components/Default/Notification';
import { useRouter } from 'next/router';
import Link from 'next/link';

const HomePage = () => {
  const router = useRouter();
  const { message, message_type } = router.query;
  const [data, setData] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get('http://localhost/eventmanage/');
        setData(response.data);
      } catch (error) {
        console.error(error);
      }
    };
    fetchData();
  }, []);
  return (
    <div className='max-w-7xl mx-auto px-4 sm:px-6 lg:px-8'>
      <Navbar />
      <div>
        {message ? <Notification message={message} message_type={message_type} /> : ""}
      </div>
      <Swiper
        slidesPerView={4.5}
        spaceBetween={20}
        scrollbar={{ hide: false, }}
        modules={[Scrollbar]}
        className=""
        breakpoints={{
          320: {
            slidesPerView: 1.5,
          },
          540: {
            slidesPerView: 2.1,
          },
          768: {
            slidesPerView: 2.5,
          },
          920: {
            slidesPerView: 3.5,
          },
          1025: {
            slidesPerView: 4.5,
          }
        }}>
        {Array.isArray(data) && data.length > 0 ? (
          data.map((item) =>
            <SwiperSlide key={item.id}>
              <div className='h-96 mt-8 mb-8'>
                <div className="flex flex-col bg-white rounded-lg shadow-lg p-4 w-64 h-full">
                  <div className="h-2/6">
                    <img
                      src={item.image ? "http://localhost/eventmanage/uploads/" + item.image : ""}
                      alt={item.name}
                      className="w-full h-full object-cover rounded-t-lg shadow-md"
                    />
                  </div>
                  <div className="text-left h-4/6 flex flex-col justify-between">
                    <div>
                      <div className='flex gap-4 items-center'>
                        <h2 className="w-2/3 text-pink-500 text-xl font-bold mb-2 mt-2">{item.name}</h2>
                        <p className="w-1/3 text-right text-gray-400 text-xs h-full mb-2 mt-2">{item.start_time.split("T")[0].split("-").reverse().join("-")}<br />{item.start_time.split("T")[1].split(":").slice(0, 2).join(":")}</p>
                      </div>
                      <p className="text-purple-500 mb-2 text-sm">
                        {item.introduction}
                      </p>
                      <p className='text-sm mb-2 mt-2 text-gray-500'>
                        Lorem ipsum lorem, ipsum dolor
                        <br />
                        Lorem ipsum lorem
                      </p>
                    </div>
                    <div className="flex">
                      <Link href={`/default/tickets/${item.id}`}>
                        <button className="bg-pink-500 text-white px-4 py-2 rounded-lg mr-2 text-sm">
                          Book Now
                        </button>
                      </Link>
                      <Link href={`/default/view/${item.id}`}>
                        <button className="bg-purple-500 text-white px-4 py-2 rounded-lg text-sm">
                          View More
                        </button>
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          )
        ) : (
          <p>No events available</p>
        )}
      </Swiper>
    </div>
  );
};

export default HomePage;