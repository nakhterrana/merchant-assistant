import { BrowserRouter, Routes, Route, NavLink, Navigate } from 'react-router-dom';

import Home from './Page/home';
import SetupGuide from './Page/setup-guide';
import Subscribe from './Page/subscribe';

export default function Router() {

    const routes = [
        {
            path: '/',
            element:  <Home /> ,
            name: "Home",
        },
        {
            path: '/subscription',
            element: <Subscribe />,
            name: "Subscription",
        },
        {
            path: '/setup-guide',
            element: <SetupGuide />,
            name: "Setup Guide",
        },
        // add more routes here
    ];

    return (

        <BrowserRouter>
            <nav className="navbar navbar-expand-lg navbar-light bg-light ">
                <div className='navbar container'>
                    <div className="navbar-nav">
                        {
                            routes.map((route, i) => {
                                const disabledStyle = route.disable ? { pointerEvents: "none", opacity: 0.5 } : {};
                                return (
                                    <NavLink key={i} style={disabledStyle} className={({ isActive }) =>
                                        isActive ? "nav-item nav-link active" : "nav-item nav-link"
                                    } to={route.path} >{route.name}</NavLink>
                                )
                            })
                        }
                    </div>
                </div>
            </nav>
            <Routes>
                {
                    routes.map((route, i) => {
                        return <Route key={i} exact path={route.path} element={route.element} />
                    })
                }
            </Routes>
        </BrowserRouter>
    )
}