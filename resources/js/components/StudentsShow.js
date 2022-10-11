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
            <table className="table-auto w-full text-center bg-gray-100 p-2 border border-collapse border-slate-400" >
                <thead>
                    <tr><th className="border border-slate-400">Id</th>
                        <th className="border border-slate-400">Last Name</th>
                        <th className="border border-slate-400">First Name</th>
                        <th className="border border-slate-400">Email</th>
                        <th className="border border-slate-400">Phone</th>
                        <th className="border border-slate-400">Program</th>
                        <th className="border border-slate-400">Updated at</th>
                        <th className="border border-slate-400">Created at</th>
                        <th className="border border-slate-400">View</th>
                        <th className="border border-slate-400">Update</th>
                        <th className="border border-slate-400">Delete</th>
                        </tr>
                </thead>

                <tbody>
                {
                    state.students?(
                        state?.students?.map((currentStudent) => (
                            <tr key={currentStudent.unique_id} className="bg-white hover:bg-gray-100">
                                <td className="border border-slate-400">{currentStudent.unique_id}</td>
                                <td className="border border-slate-400">{currentStudent.last_name}</td>
                                <td className="border border-slate-400">{currentStudent.first_name}</td>
                                <td className="border border-slate-400">{currentStudent.email}</td>
                                <td className="border border-slate-400">{currentStudent.phone}</td>
                                <td className="border border-slate-400">{currentStudent.program_id}</td>
                                <td className="border border-slate-400">{currentStudent.updated_at}</td>
                                <td className="border border-slate-400">{currentStudent.created_at}</td>
                                <td className="border border-slate-400"><a href={'/viewStudent/'+currentStudent.unique_id} className="text-green-500 cursor-pointer">View</a></td>
                                <td className="border border-slate-400"><a href={'/editStudent/'+currentStudent.unique_id} className="text-orange-500 cursor-pointer">Update</a></td>
                                <td className="border border-slate-400"><a href={'/removeStudent/'+currentStudent.unique_id} className="text-red-500 cursor-pointer">Trash</a></td>
                            </tr>))
                    ) : (<tr className="border border-slate-400">Loading...</tr>)
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