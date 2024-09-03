import React, { useEffect, useState } from "react";
import { BarChart, Bar, CartesianGrid, XAxis, Tooltip, Legend } from "recharts";
import axios from "axios";

function MyChart() {
    const [data, setData] = useState([]);

    useEffect(() => {
        async function fetchData() {
            const response = await axios.get('/api/chart-data');
            setData(response.data);
        }

        fetchData();
    }, []);

    return (
        <BarChart width={600} height={300} data={data}>
            <CartesianGrid strokeDasharray="3 3" />
            <XAxis dataKey="month" />
            <Tooltip />
            <Legend />
            <Bar dataKey="desktop" fill="#8884d8" />
            <Bar dataKey="mobile" fill="#82ca9d" />
        </BarChart>
    );
}

export default MyChart;
