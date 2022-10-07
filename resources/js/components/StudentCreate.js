// import React
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
// import { useNavigate } from 'react-router-dom'
// import {BrowserRouter as Router} from 'react-router-dom';

function CreateStudents() {
    // const naviagate = useNavigate()

    // https://www.codecheef.org/article/laravel-8-react-js-fetch-data-example
    // fetch program info
    const[state, programData] = useState({programs: ''})

    const fetchProgram = async() =>{
        const api = await fetch("/programs");
        programData({
            programs: await api.json()
        })
    }
    useEffect(() => {
        fetchProgram();
    }, [])

    // form variables
    const [last_name, setLastName] = useState("")
    const [first_name, setFirstName] = useState("")
    const [email, setEmail] = useState("")
    const [phone, setPhone] = useState("")
    // set program with default value
    const [program, setProgram] = useState("Bachelor of Arts")
    const [validation, setValidation] = useState({})


    const createStudent = async(e) =>{
        e.preventDefault()
        
        let formData = new FormData()

        formData.append('last_name', last_name)
        formData.append('first_name', first_name)
        formData.append('email', email)
        formData.append('phone', phone)
        formData.append('program', program)
        
        await axios.post('/api/student', formData).then(({data})=>{
        }).catch(({response})=>{
            console.log(response)
          if(response.status===422){
            //422 validation error
            setValidation(response.data.errors)
          }else{
            //other errors
            setValidation(response.data.errors)
          }
        })
    }

    return (
        <form className="w-11/12 pt-5 mx-auto" onSubmit={createStudent}>
            
            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center py-5">
                    <label htmlFor="last-name" className="p-3 font-bold text-lg">Last Name:</label>
                    <input type="text" name="last-name" value={last_name} onChange={(event)=>{setLastName(event.target.value)}}/>
                </div>
            </div>

            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center py-5">
                    <label htmlFor="first-name" className="p-3 font-bold text-lg">First Name:</label>
                    <input type="text" name="first-name" value={first_name} onChange={(event)=>{setFirstName(event.target.value)}}/>
                </div>
            </div>

            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center py-5">
                    <label htmlFor="email" className="p-3 font-bold text-lg">Email:</label>
                    <input type="text" name="email" value={email} onChange={(event)=>{setEmail(event.target.value)}}/>
                </div>
            </div>

            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center py-5">
                    <label htmlFor="phone" className="p-3 font-bold text-lg">Phone:</label>
                    <input type="text" name="phone" value={phone} onChange={(event)=>{setPhone(event.target.value)}}/>
                </div>
            </div>

            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center py-5">
                    <label htmlFor="program" className="p-3 font-bold text-lg">Program:</label>
                    <select name="program" id="program" className="mx-3" defaultValue="Bachelor of Arts" onChange={(event)=>{setProgram(event.target.value)}}>
                    {
                        state?.programs ?
                            state?.programs?.map((currentProgram) => (
                                <option key={currentProgram.program} value={currentProgram.program}>{currentProgram.program}</option>
                                ))
                        : <option value="" disabled>waiting</option>
                    }
                            
                    </select>

                </div>
            </div>

            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center border border-2 py-5">
                    <input className="rounded m-2 py-2 w-full  text-black cursor-pointer" type="submit" value="Confirm"/>
                </div>      
            </div>

            <div className="w-11/12 mx-auto text-red-600">
                    {Object.keys(validation).length > 0 ? (
                        Object.entries(validation).map(([k,v]) =>(
                            <h1 key={k}>{v}</h1>
                            ))
                        
                      ) : (
                        <h1></h1>
                      )}   
            </div>
        </form>
    );
}

export default CreateStudents;

// DOM element
if (document.getElementById('studentCreate')) {
    ReactDOM.render(<CreateStudents />, document.getElementById('studentCreate'));
}