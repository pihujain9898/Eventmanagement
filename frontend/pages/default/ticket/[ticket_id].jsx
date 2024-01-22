import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useRouter } from 'next/router';
import Link from 'next/link';


export default function TicketId() {
    const router = useRouter();
    const {ticket, ticket_id} = router.query;
    const [data, setData] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
        try {
          const response = await axios.get(`http://localhost/eventmanage/default/ticket/${ticket_id}`);
          setData(response.data);
        } catch (error) {
          console.error(error);
        }
      };
      if(ticket_id)
        fetchData();
    }, [ticket_id]);
    // console.log(data.event_association ? data.event_association.id : '');
  return (
    <div className="">
      <Link style={{color: 'royalblue'}} href={`/default/tickets/${data.event_association ? data.event_association.id : ''}`}>
        All tickets 
      </Link>
      {data ? 
            <div>
                <h1>Ticket Name: {data.avilable_quantity}</h1>
                <h1>Description: {data.description}</h1>
                <h1>Ticket Id: {data.id}</h1>
                <h1>Price: {data.price}</h1>
                <h1>Category: {data.ticketCategory_association ? data.ticketCategory_association.name : ''}</h1>
                <h1>Event: {data.event_association ? data.event_association.name : ''}</h1>
                <h1>Total Quantity: {data.total_quantity}</h1>
                <h1>Avilable Quantity: {data.avilable_quantity}</h1>
                <h1>Max Purchase Value: {data.max_purchase_value}</h1>
                <h1>Expiry: {data.expiry}</h1>                
            </div>
       : (
        <p>No such ticket available</p>
      )}
    </div>
  )
}
