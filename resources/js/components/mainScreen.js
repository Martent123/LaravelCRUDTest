// import React
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Routes, Route, useParams} from "react-router-dom";
import StudentList from "./StudentList";
import StudentCreate from "./StudentCreate";
import StudentView from "./StudentView";

function MainScreen() {

    return (
        <Routes>
            <Route path="/" element={<StudentList /> } />
            <Route path="/StudentShow/:id" element={<StudentView /> } />
            <Route path="/StudentCreate" element={<StudentCreate /> } />
            <Route path="/StudentRemove" element={<StudentList /> } />
            <Route path="/StudentEdit" element={<StudentList /> } />
        </Routes>
    );
}

export default MainScreen;

// DOM element
if (document.getElementById('mainScreen')) {
    ReactDOM.render(<BrowserRouter>
            <MainScreen />
        </BrowserRouter>, document.getElementById('mainScreen'));
}