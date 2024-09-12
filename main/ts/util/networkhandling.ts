export namespace Networking {
    const BASE_URL = "http://cop4331team21.site"
    
    export function postJsonToServer(payload: object | BodyInit, subdir: string,
                                     additionalHeaders?: { [key: string]: any }): Promise<Response> {
        if (!subdir.startsWith('/'))
            subdir = '/' + subdir;
        
        const headersObj = additionalHeaders || {};
        
        if (!headersObj['Content-Type']) {
            headersObj['Content-Type'] = 'application/json'
        }
        
        if (typeof payload === 'object')
            payload = JSON.stringify(payload)
        
        return fetch(/*BASE_URL +*/ subdir, {
            method: "POST",
            body: payload,
            headers: headersObj
        })
    }
    
    export function postToLAMPAPI(payload: any, endpointName: string) {
        return postJsonToServer(payload, `/LAMPAPI/${endpointName}.php`)
    }
}

