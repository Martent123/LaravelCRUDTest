// import React
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';

function StudentsShow() {
    // fetch students info
    const[state, studentData] = useState({students: ''})

    const fetchProgram = async() =>{
        const api = await fetch("/api/students");
        studentData({
            students: await api.json()
        })
    }
    useEffect(() => {
        fetchProgram();
    }, [])
    
    console.log(state.students)

    return (
            <table className="table-auto w-full text-center bg-gray-100 border p-2" >
                <thead>
                    <tr><th>Id</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Program</th>
                        <th>Updated at</th>
                        <th>Created at</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>
                        </tr>
                </thead>

                <tbody>
                {
                    state.students?(
                        state?.students?.map((currentStudent) => (
                            <tr key={currentStudent.unique_id} className="bg-white hover:bg-gray-100">
                                <td>{currentStudent.unique_id}</td>
                                <td>{currentStudent.last_name}</td>
                                <td>{currentStudent.first_name}</td>
                                <td>{currentStudent.email}</td>
                                <td>{currentStudent.phone}</td>
                                <td>{currentStudent.program_id}</td>
                                <td>{currentStudent.updated_at}</td>
                                <td>{currentStudent.created_at}</td>
                                <td><a href={'/removeStudent/'+currentStudent.unique_id} className="text-green-500 cursor-pointer">View</a></td>
                                <td><a href={'/removeStudent/'+currentStudent.unique_id} className="text-orange-500 cursor-pointer">Update</a></td>
                                <td><a href={'/removeStudent/'+currentStudent.unique_id} className="text-red-500 cursor-pointer">Trash</a></td>
                            </tr>))
                    ) : (<tr>Loading...</tr>)
                }
                <tr><td colSpan="11">
                    <a href={'/studentCreate'} className="text-green cursor-pointer">Add new student</a>
                </td></tr>
                </tbody>
            </table>

    );
}

export default StudentsShow;

// DOM element
if (document.getElementById('studentsShow')) {
    ReactDOM.render(<StudentsShow />, document.getElementById('studentsShow'));
}