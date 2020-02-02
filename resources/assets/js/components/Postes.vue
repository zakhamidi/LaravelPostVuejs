<template>
  <div>
    <h2>Postes</h2>
    <form @submit.prevent="addPoste" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" v-model="poste.title">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Body" v-model="poste.body"></textarea>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPostes(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPostes(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    <div class="card card-body mb-2" v-for="poste in Postes" v-bind:key="poste.id">
      <h3>{{ poste.title }}</h3>
      <p>{{ poste.body }}</p>
      <hr>
      <button @click="editPoste(poste)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deletePoste(poste.id)" class="btn btn-danger">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      Postes: [],
      poste: {
        id: '',
        title: '',
        body: ''
      },
      Poste_id: '',
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchPostes();
  },

  methods: {
    fetchPostes(page_url) {
      let vm = this;
      page_url = page_url || '/api/Postes';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.Postes = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    deletePoste(id) {
      if (confirm('Are You Sure?')) {
        fetch(`api/poste/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('poste Removed');
            this.fetchPostes();
          })
          .catch(err => console.log(err));
      }
    },
    addPoste() {
      if (this.edit === false) {
        // Add
        fetch('api/poste', {
          method: 'post',
          body: JSON.stringify(this.poste),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('poste Added');
            this.fetchPostes();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/poste', {
          method: 'put',
          body: JSON.stringify(this.poste),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('poste Updated');
            this.fetchPostes();
          })
          .catch(err => console.log(err));
      }
    },
    editPoste(poste) {
      this.edit = true;
      this.poste.id = poste.id;
      this.poste.Poste_id = poste.id;
      this.poste.title = poste.title;
      this.poste.body = poste.body;
    },
    clearForm() {
      this.edit = false;
      this.poste.id = null;
      this.poste.Poste_id = null;
      this.poste.title = '';
      this.poste.body = '';
    }
  }
};
</script>
