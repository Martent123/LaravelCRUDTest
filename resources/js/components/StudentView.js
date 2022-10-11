// import React
import React, { useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import {
  useParams
} from 'react-router-dom';

function StudentView() {
	let params = useParams()
	let studentId = params.id
    // fetch students info
    const[state, studentData] = useState({students: ''})

    const fetchStudent = async() =>{
        const api = await fetch("/api/students/" + studentId );
        studentData({
            students: await api.json()
        })
    }
    useEffect(() => {
        fetchStudent();
    }, [])
    
    console.log(state.students)

    return (
    	<div>
    		test
    		 <h2></h2>
    	</div>
    );
}

export default StudentView;