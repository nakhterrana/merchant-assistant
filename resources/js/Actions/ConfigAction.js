// actions.js
export const CHECK_CONFIG_REQUEST = 'CHECK_CONFIG_REQUEST';
export const CHECK_CONFIG_SUCCESS = 'CHECK_CONFIG_SUCCESS';
export const CHECK_CONFIG_FAILURE = 'CHECK_CONFIG_FAILURE';

export const checkConfigRequest = () => ({
    type: CHECK_CONFIG_REQUEST,
});

export const checkConfigSuccess = (configExists) => ({
    type: CHECK_CONFIG_SUCCESS,
    payload: { configExists },
});

export const checkConfigFailure = (error) => ({
    type: CHECK_CONFIG_FAILURE,
    payload: { error },
});