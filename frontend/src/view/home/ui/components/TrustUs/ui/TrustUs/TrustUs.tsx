"use client";
import { useInfiniteReviews } from "@/entities/trustUs/api/trustUsApi";
import { Reviews } from "../Reviews/Reviews";
import styles from "./TrustUs.module.scss";

export const TrustUs = () => {
  const { data } = useInfiniteReviews();
  const reviews = data?.pages.flatMap((page) => page.data.items) || [];
  return (
    <section className={styles.trustUs}>
      <div className={styles.title}>Нам доверяют</div>
      <Reviews reviews={reviews} />
    </section>
  );
};
