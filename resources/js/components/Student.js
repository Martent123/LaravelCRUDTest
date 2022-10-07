// import React
import React from 'react';
import ReactDOM from 'react-dom';

function Students() {
    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>STUDENTS!!!!</h2></div>

                        <div className="card-body">I'm tiny React component in Laravel app!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Students;

// DOM element
if (document.getElementById('students')) {
    ReactDOM.render(<Students />, document.getElementById('students'));
}