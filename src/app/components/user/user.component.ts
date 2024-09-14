import { Component, OnInit } from '@angular/core';
import { UserService } from '../../services/user.service';
import { User } from '../../models/user.model';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-users',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
  users: User[] = [];
  userForm: FormGroup;
  errorMessage: string | null = null;

  constructor(private userService: UserService, private fb: FormBuilder) {
    // Initialize the form
    this.userForm = this.fb.group({
      name: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }

  ngOnInit(): void {
    this.loadUsers();
  }

  // Load users from the API
  loadUsers(): void {
    this.userService.getUsers().subscribe(
      (data: User[]) => {
        this.users = data;
        this.errorMessage = null;
      },
      (error) => {
        this.errorMessage = 'Failed to load users';
        console.error(error);
      }
    );
  }

  // Add a new user
  addUser(): void {
    if (this.userForm.invalid) {
      return;
    }

    this.userService.createUser(this.userForm.value).subscribe(
      (newUser: User) => {
        this.users.push(newUser);
        this.userForm.reset();
        this.errorMessage = null;
      },
      (error) => {
        this.errorMessage = 'Failed to add user';
        console.error(error);
      }
    );
  }

  // Delete a user
  deleteUser(id: number): void {
    this.userService.deleteUser(id).subscribe(
      () => {
        this.users = this.users.filter((user) => user.id !== id);
        this.errorMessage = null;
      },
      (error) => {
        this.errorMessage = 'Failed to delete user';
        console.error(error);
      }
    );
  }
}
