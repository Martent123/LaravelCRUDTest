// import React
import React, { useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import { useParams } from 'react-router-dom';
    
    //return button
    const Returnbtn = () =>{
        return <div className="w-11/12 mx-auto">
            <div className="mx-auto w-1/2 flex justify-center border border-2 py-3 bg-green-400 rounded-3xl">
                <a href="/" className="rounded py-2 w-full font-bold text-gray-200 cursor-pointer text-center">Return</a>
            </div>      
        </div>
    };

    function StudentView() {
       let params = useParams()
       let studentId = params.id
        // fetch students info
        const[studentState, studentData] = useState({students: ''})

        const fetchStudent = async() =>{
            const api = await fetch("/api/students/" + studentId )
            let targetStudent = await api.json()
            //set default values
            setLastName(targetStudent.data[0].last_name)
            setFirstName(targetStudent.data[0].first_name)
            setEmail(targetStudent.data[0].email)
            setPhone(targetStudent.data[0].phone)
            setProgram(targetStudent.data[0].program)

        }



    // fetch program info
    const[programState, programData] = useState({programs: ''})

    const fetchProgram = async() =>{
        const api = await fetch("/api/programs");
        programData({
            programs: await api.json()
        })
        
    }

    // console.log(studentState.students)
    // console.log(programState.programs)

    // set form variables
    const [last_name, setLastName] = useState("")
    const [first_name, setFirstName] = useState("")
    const [email, setEmail] = useState("")
    const [phone, setPhone] = useState("")
    // set program with default value
    const [program, setProgram] = useState("Computer Science")
    const [validation, setValidation] = useState({})

    useEffect(() => {
        fetchStudent();
        fetchProgram();
    }, [])

    // function to update the student information
    const updateStudent = async(e) =>{
        e.preventDefault()
        
        let formData = new FormData()

        formData.append('last_name', last_name)
        formData.append('first_name', first_name)
        formData.append('email', email)
        formData.append('phone', phone)
        formData.append('program', program)

        // laravel problem. doesnt support put with muiltipart. work around
        formData.append('_method',"put")

        await axios.post('/api/students/'+studentId, formData).then(
            ({data})=>{
                // sucess redirect
                window.location = "/"
            }).catch(({response})=>{
                console.log(response)
                if(response.status===422){
                    //422 validation error
                    setValidation(response.data.errors)
                }else{
                    //other errors
                    setValidation([response.data.message])
                }
            })
        }




        return (
           <form className="w-11/12 pt-5 mx-auto" onSubmit={updateStudent} encType="multipart/form-data">
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
               <select name="program" id="program" className="mx-3" value={program} onChange={(event)=>{setProgram(event.target.value)}}>
               {
                programState?.programs ?
                programState?.programs.data?.map((currentProgram) => (
                    <option key={currentProgram.program} value={currentProgram.program}>{currentProgram.program}</option>
                    ))
                : <option value="" disabled>waiting</option>
            }

            </select>

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

            <div className="w-11/12 mx-auto">
                <div className="mx-auto w-1/2 flex justify-center border border-2 py-3 bg-amber-400 rounded-3xl">
                    <input className="rounded py-2 w-full font-bold text-gray-200 cursor-pointer" type="submit" value="Update"/>
                </div>

            </div>

            <Returnbtn />
            </form>
            );
    }

    export default StudentView;