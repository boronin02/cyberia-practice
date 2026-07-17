"use client";
import { Review } from "../Review";
import styles from "./Reviews.module.scss";
import { ReviewsResource } from "@/entities/reviews/api/types";

interface ReviewsProps {
  reviews: ReviewsResource[];
}

export const Reviews = ({ reviews }: ReviewsProps) => {
  return (
    <section className={styles.reviews}>
      <div className={styles.title}>Нам доверяют</div>
      <Review reviews={reviews} />
    </section>
  );
};
