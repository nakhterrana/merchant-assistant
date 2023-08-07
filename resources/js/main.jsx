import React, { useEffect } from 'react';
import { checkConfigRequest } from "./Actions/ConfigAction";
import { useDispatch, useSelector } from 'react-redux';
import Router from "./routes";

const Main = () => {

    const dispatch = useDispatch();
    const error = useSelector(state => state.error);
    useEffect(() => {
        dispatch(checkConfigRequest());
    }, [dispatch]);

    // if (error) {
    //     console.error(error);
    //     return <h1>Something went wrong.</h1>;
    // }

    return (
        <div className="Wrapper">
           <Router  />
        </div>

    )
}

export default Main;