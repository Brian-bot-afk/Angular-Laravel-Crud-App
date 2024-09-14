import { Component, OnInit } from '@angular/core';
import { UserService } from './services/user.service';
import { PostService } from './services/post.service';
import { CategoryService } from './services/category.service';
import { ReactiveFormsModule } from '@angular/forms';  // Import ReactiveFormsModule

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  title = 'myapp';
  users: any[] = [];
  posts: any[] = [];
  categories: any[] = [];

  constructor(
    private userService: UserService,
    private postService: PostService,
    private categoryService: CategoryService
  ) {}

  ngOnInit(): void {
    // Fetch all users
    this.userService.getUsers().subscribe((data) => {
      this.users = data;
    });

    // Fetch all posts
    this.postService.getPosts().subscribe((data) => {
      this.posts = data;
    });

    // Fetch all categories
    this.categoryService.getCategories().subscribe((data) => {
      this.categories = data;
    });
  }
}
