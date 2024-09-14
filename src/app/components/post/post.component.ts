import { Component, OnInit } from '@angular/core';
import { PostService } from '../../services/post.service';
import { Post } from '../../models/post.model';

@Component({
  selector: 'app-posts',
  templateUrl: './post.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
  posts: Post[] = [];
 // Placeholder for categories
  newPost: Post = {
    userId: 0, // This can be auto-generated in the backend
    title: '',
    content: '',
    category: ''
  };

  constructor(private postService: PostService) {}

  ngOnInit(): void {
    // Fetch existing posts
    this.postService.getPosts().subscribe((data: Post[]) => {
      this.posts = data;
    });
  }

  // Method to create a new post
  createPost(): void {
    if (this.newPost.title && this.newPost.content && this.newPost.category) {
      this.postService.createPost(this.newPost).subscribe((createdPost: Post) => {
        this.posts.push(createdPost);
        // Reset the form after successful submission
        this.newPost = { userId: 0, title: '', content: '', category: '' };
      });
    }
  }

  // Method to delete a post
  deletePost(id: number): void {
    this.postService.deletePost(id).subscribe(() => {
      this.posts = this.posts.filter(post => post.userId !== id);
    });
  }
}
