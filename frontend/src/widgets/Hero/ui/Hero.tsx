import styles from "./Hero.module.css";
import Image from "next/image";
import { Logos } from "./Logos";

export const Hero = () => {
  return (
    <>
      <section className={styles.hero}>
        <div className={styles.content}>
          <div className={styles.left}>
            <div className={styles.title}>
              <h2>Разрабатываем сложные ITпродукты: е-ком, веб-сервисы, ИИ</h2>
            </div>
            <div className={styles.subtitle}>
              <div className={styles.subtitleLeft}>
                <button className={styles.button}>Обсудить проект</button>
                <div className={styles.social}>
                  <div className={styles.imgBox}>
                    <Image src="/hero/tg.svg" alt="tg" width={12} height={10} />
                  </div>
                  <div className={styles.imgBox}>
                    <Image
                      src="/hero/max.svg"
                      alt="tg"
                      width={12}
                      height={10}
                    />
                  </div>
                  <div className={styles.imgBox}>
                    <Image src="/hero/vk.svg" alt="tg" width={12} height={10} />
                  </div>
                </div>
              </div>
              <div className={styles.subtitleRigth}>
                <div className={styles.raiting}>
                  <div className={styles.raitingNumber}>
                    <span className={styles.number}>23</span>
                    <span className={styles.place}>место</span>
                  </div>
                  <div className={styles.text}>
                    Разработка решений на базе ИИ
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className={styles.rigth}>
            <Image
              src="/hero/people.png"
              alt="people"
              width={561}
              height={377}
              className={styles.people}
            />
          </div>
        </div>
        <Image
          src="/1.png"
          alt="1"
          width={864}
          height={819}
          className={styles.bgImg}
        />
      </section>
      <Logos />
    </>
  );
};
