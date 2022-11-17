import React from 'react';
import ReactDOM from 'react-dom';

function Docs() {
    return (
        <div className="w-11/12 mx-auto">
           <h1 className="font-bold text-xl">A Simple CRUD Laravel Application</h1>
           <h2 className="font-bold text-lg">Available Endpoints</h2>
           <ul className="list-disc">
            <li className="py-1">
                <p className="text-red-600">GET:/api/students</p>                   
                <p>List All Students</p>
            </li>

            <li className="py-1">
                <p className="text-red-600">GET:/api/students/&#123;id&#125;</p>                  
                <p>List Student with input id (if there is one)</p>
            </li>

            <li className="py-1">
                <p className="text-red-600">GET:/api/students/&#123;id&#125;</p>                  
                <p>Create A new student</p>
            </li>

            <li className="py-1">
                <p className="text-red-600">PUT:/api/students/&#123;id&#125;</p>              
                <p>Update Target Student</p>
            </li>

            <li className="py-1">
                <p className="text-red-600">DELETE:/api/students/&#123;id&#125;</p>                 
                <p>Remove Target Student</p>
            </li>

            <li className="py-1">
                <p className="text-red-600">GET:/api/programs</p>                  
                <p>List All Programs Available</p>
            </li>
           </ul>
        </div>
    );
}

export default Docs;