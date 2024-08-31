import React, { useEffect, useState } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
import { show_alerta } from '../functions';

export const ShowEmployees = () => {
    // Haciendo uso de la api que se creo para el backend
    const url = 'http://localhost/backend/api/api.php'
    const [items, setItems] = useState([]); // Llama la tabla de la api
    // Columnas de la tabla Items
    const [id, setId] = useState('');
    const [name, setName] = useState('');
    const [lastname, setLastname] = useState('');
    const [age, setAge] = useState('');
    const [email, setEmail] = useState('');
    const [area, setArea] = useState('');
    const [job, setJob] = useState('');
    // Tipo de operación a realizar
    const [operation,setOperation] = useState(1);
    // Titulo de el modal
    const [title,setTitle] = useState('');

    useEffect( () => {
        getItems();
    }, []);

    const getItems = async () => {
        const respuesta = await axios.get(url)
        setItems(respuesta.data);
    }

  return (
    <div className = 'App'>
        <div className = 'container-fluid'>  
            <div className='row mt-3'>
                <div className='col-md-4 offset-md-4'>
                    <div className='d-grid-mx-auto'>
                        <button className='btn btn-dark' data-bs-toggle='modal' data-bs-target='#modalEmployees'>
                            <i className='fa-solid fa-circle-plus'></i>Añadir
                        </button>
                    </div>
                </div>
            </div>
            <div className='row mt-3'>
                <div className='col-12 col-lg-8 offset-0 offset-lg-2'>
                    <div className='table-responsive'>
                        <table className='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>ID</th><th>NOMBRE</th><th>APELLIDO</th><th>EDAD</th><th>EMAIL</th><th>AREA</th><th>PUESTO</th>
                                </tr>
                                <tbody className='table-group-divider'>
                                    {items.map( (item, id) => (
                                        <tr key = {item.id}>
                                            <td>({})</td>
                                            <td>{item.name}</td>
                                            <td>{item.lastname}</td>
                                            <td>{item.age}</td>
                                            <td>{item.email}</td>
                                            <td>{item.area}</td>
                                            <td>{item.job}</td>                                            
                                            <td>
                                                <button className='btn btn-warning'>
                                                    <i className='fa-solid fa-edit'></i>
                                                </button>
                                                &nbsp;
                                                <button className='btn btn-danger'>
                                                    <i className='fa-solid fa-trasj'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                    }
                                </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  )
}

export default ShowEmployees