import './bootstrap';
import '../sass/app.scss'
import '../css/app.css'

import ReactDOM from 'react-dom/client';
import Main from './main';
import { Provider } from 'react-redux';
import store from './store';

ReactDOM.createRoot(document.getElementById('app')).render(
    <Provider store={store}>
        <Main />
    </Provider>
);