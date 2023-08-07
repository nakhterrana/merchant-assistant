import { configureStore } from '@reduxjs/toolkit';
import createSagaMiddleware from 'redux-saga';
import configReducer from './Reducer/ConfigReducer';
import configSaga from './Saga/ConfigSaga';

const sagaMiddleware = createSagaMiddleware();

const store = configureStore({
    reducer: configReducer,
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(sagaMiddleware),
});

sagaMiddleware.run(configSaga);

export default store;
