// import React
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import  { Navigate, useParams } from 'react-router-dom'

function StudentRemove(){

	let params = useParams()
	let studentId = params.id

	// action for return btn
	const returnBtn = ()=>{
		window.location = "/"
	}

	// action for remove button
	const removeStudent = async(e) =>{
        e.preventDefault()
        
        await axios.delete('/api/students/'+studentId).then(
            ({data})=>{
            console.log(data)
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
    	<div className='w-11/12 pt-5 mx-auto'>
    		<h1 className='text-center font-bold'>Are you sure?</h1>
    		<div className='flex py-5'>
    			<div className='mx-auto'>
    				<button onClick={removeStudent} className="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-5 rounded">Remove</button>
    			</div>
    			<div className='mx-auto'>
    				<button onClick={returnBtn} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-5 rounded">Return</button>
    			</div>
    		</div>
    	</div>
    	)
    	
    }
    export default StudentRemove;