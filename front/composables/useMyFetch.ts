export const useMyFetch: any = (request:any, opts:any) => {

    const config = useRuntimeConfig()

    return useFetch(request, { baseURL: config.public.apiURL, ...opts }).then(({ data, pending, error, refresh }) => {

        return {
            data,
            pending,
            error,
            refresh
        };
    }).catch((error) => {
            console.log('Error fetch')
            throw error;
    });
}