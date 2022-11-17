// import React
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';


function StudentList() {
    // fetch students info
    const[state, studentData] = useState({students: ''})

    const fetchStudents = async() =>{
        const api = await fetch("/api/students");
        studentData({
            students: await api.json()
        })
    }
    useEffect(() => {
        fetchStudents();
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
                        <th className="border border-slate-400">Delete</th>
                        </tr>
                </thead>

                <tbody>
                {
                    Array.isArray(state.students.data)?(
                        state?.students?.data?.map((currentStudent) => (
                            <tr key={currentStudent.unique_id} className="bg-white hover:bg-gray-100">
                                <td className="border border-slate-400">{currentStudent.unique_id}</td>
                                <td className="border border-slate-400">{currentStudent.last_name}</td>
                                <td className="border border-slate-400">{currentStudent.first_name}</td>
                                <td className="border border-slate-400">{currentStudent.email}</td>
                                <td className="border border-slate-400">{currentStudent.phone}</td>
                                <td className="border border-slate-400">{currentStudent.program}</td>
                                <td className="border border-slate-400">{currentStudent.updated_at}</td>
                                <td className="border border-slate-400">{currentStudent.created_at}</td>
                                <td className="border border-slate-400"><a href={'/StudentView/'+currentStudent.unique_id} className="text-green-500 cursor-pointer">View</a></td>
                                <td className="border border-slate-400"><a href={'/StudentRemove/'+currentStudent.unique_id} className="text-red-500 cursor-pointer">Trash</a></td>
                            </tr>))
                    ) : (<tr className="border border-slate-400"><td colSpan="11">No Data Available</td></tr>)
                }
                <tr><td colSpan="11">
                    <a href={'/studentCreate'} className="text-green cursor-pointer">Add new student</a>
                </td></tr>
                </tbody>
            </table>

    );
}

export default StudentList;

// DOM element
// if (document.getElementById('StudentList')) {
//     ReactDOM.render(<StudentList />, document.getElementById('StudentList'));
// }