import React from 'react';

const Loader = ({ isLoading }) => {
    return (
        isLoading && (
            <div className="overlay">
                <div className="d-flex justify-content-center">
                    <div className="spinner-grow" role="status">
                        <span className="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        )
    )
}

export default Loader;