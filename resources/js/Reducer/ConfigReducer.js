
// reducer.js
import { CHECK_CONFIG_SUCCESS, CHECK_CONFIG_FAILURE } from '../Actions/ConfigAction';

const initialState = {
    configExists: null,
    error: null,
};

const configReducer = (state = initialState, action) => {
    switch (action.type) {
        case CHECK_CONFIG_SUCCESS:
            return { ...state, configExists: action.payload.configExists };
        case CHECK_CONFIG_FAILURE:
            return { ...state, error: action.payload.error };
        default:
            return state;
    }
};

export default configReducer;