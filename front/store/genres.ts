import { defineStore } from 'pinia';

export const useGenreStore = defineStore('genres', {

    state: () => ({
        genres: [],
        genreIds: '',
    }),
    getters: {
        getGenres(state) {
            return state.genres;
        },
    },
    actions: {
        push(genre:any) {
            this.genres.push(genre)
            this.genreIds = this.genres.map((item:any) => {return item.id}).join(',');
        },
        remove(genre:any) {

            let index = this.genres.indexOf(genre);

            if (index !== -1) {
                this.genres.splice(index, 1);
            }

            this.genreIds = this.genres.map((item:any) => {return item.id}).join(',');

        }
    },
});