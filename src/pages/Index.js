import React from 'react';
import { Joueur } from './../data';
const Index = () => {
    const conference = {
        color: 'white',
        fontWeight: 'bold',
        fontSize:'large',
        padding: "15px",
        margin:'0px'
    };
    const th = {
        color: 'white',
        background:'#032e50',
        textAlign:'center',
        height:"1.2cm"
    };
    const image='./p.jpg';
    const Person = ({ person }) => {
        return (
            <tr>
                <td className='text-center'>{person.id}</td>
                <td>
                    <img src={image} alt="joueur" className='rounded-circle' width="50" height="50"></img>
                    <span style={{marginLeft:'15px'}}>{person.nom}</span>
                </td>
                <td className='text-center'>{person.equipe}</td>
                <td className='text-center'>{person.mj}</td>
                <td className='text-center'>{person.ppm}</td>
                <td className='text-center'>{person.rpm}</td>
                <td className='text-center'>{person.pdpm}</td>
                <td className='text-center'>{person.mpm}</td>
                <td className='text-center'>{person.eff}</td>
            </tr>
        );
    };
    return(
        <>
            <div className='row justify-content-center'>
                <div className='col-md-10'>
                    <div style={{background:'blue'}}>
                        <p style={conference}> 2023-2024 SAISON STATS</p>                    
                    </div>
                    <div>
                        <table class="table table-striped table-responsive projects">
                            <thead>
                                <tr>
                                    <th style={th}>CLASSEMENT</th>
                                    <th style={th}>JOUEUR</th>
                                    <th style={th}>EQUIPE</th>
                                    <th style={th}>MJ</th>
                                    <th style={th}>PPM</th>
                                    <th style={th}>RPM</th>
                                    <th style={th}>PDPM</th>
                                    <th style={th}>MPM</th>
                                    <th style={th}>EFF</th>
                                </tr>
                            </thead>
                            <tbody>
                            {Joueur.map(person => (
                                <Person key={person.id} person={person} />
                            ))}
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </>
    );
};
export default Index;