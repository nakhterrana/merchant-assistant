// sagas.js
import { put, call, takeLatest } from 'redux-saga/effects';
import {
    CHECK_CONFIG_REQUEST,
    checkConfigSuccess,
    checkConfigFailure,
} from '../Actions/ConfigAction';
import Constants from '../Helper/constants';

function* checkConfig() {
    try {
        const response = yield call(axios.get, Constants.STORE_PATH + 'check-config');
        yield put(checkConfigSuccess(response.data.data));
    } catch (error) {
        yield put(checkConfigFailure(error));
    }
}

function* configSaga() {
    yield takeLatest(CHECK_CONFIG_REQUEST, checkConfig);
}

export default configSaga;